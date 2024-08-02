from machine import Pin
from time import sleep
import utime

import wifi_management
import lcd_management
import keypad_management
import relay_management

import urequests
import json

lcd = lcd_management.get_lcd()

baseUrl = "http://192.168.249.72/washing-machine-management/public/api/turn-on-washing-machine"

wifi_management.connectWifi(lcd)

relay_management.test()

attempt = 0
key, code = '', ""
lcd_management.printMessage(lcd, f"Code: {code}")

while attempt < 100:

    connectivity, status = wifi_management.check_ping()
    current_date = utime.time()
    
    relay_management.turn_of_ended_relays(current_date)
    
    if status:
        
        block = 0
        while block < 20:
            key = keypad_management.read_key()
            if key != None:
                
                code += key
                lcd_management.printMessage(lcd, f"Code: {code}")
                break
            block += 1
            sleep(0.05)
        if key == "#":
        
            url = f"{baseUrl}/{code[:-1]}"
            lcd_management.printMessage(lcd, f"Asking Server...")
            
            try:
                response = urequests.post(url)
                reserve = json.loads(response.content)
                print(reserve)
                if reserve['status']:
                    year, month, day, hour, minute, second = map(int, reserve['endTime'].replace("-", " ").replace(":", " ").split())
                    given_date = utime.mktime((year, month, day, hour, minute, second, 0, 0))

                    if given_date > current_date:
                        relay_management.turn_on(reserve['machineCode'])
                        relay_management.set_endAt(reserve['machineCode'],given_date)
                else:
                    lcd_management.printMessage(lcd, "No Reservation!!")
                 
                key, code = '', ""
                sleep(2)
                lcd_management.printMessage(lcd, f"Code: {code}")
            
            except:
                lcd_management.printMessage(lcd, f"Server Not available !")
                key, code = '', ""
                sleep(2)
                lcd_management.printMessage(lcd, f"Code: {code}")
            
    else:
        attempt += 1
        lcd_management.printMessage(lcd, connectivity)
        sleep(0.1)
    
    sleep(0.05)
        
    





  