import network
from time import sleep
import os
import lcd_management
import urequests

station = network.WLAN(network.STA_IF)
station.active(True)

ssid = "Galaxy Note10+85cf"
password = "102031510006016"
    
    
def connectWifi(lcd = None):
    
    lcd_management.printMessage(lcd, f"Connecting to {ssid}")

    station.connect(ssid, password)

    attempt = 0
    while station.isconnected() == False and attempt < 1000:
        sleep(0.05)
        attempt += 1

    if station.isconnected() == False:
        lcd_management.printMessage(lcd, f"Unenable to Connect Wifi")
    else:
        lcd_management.printMessage(lcd, f"Successfully Connected to Wifi")
        sleep(2)
            
            
def check_ping():
    hostname = "http://clients3.google.com/generate_204"
    status = False
    try:
        response = urequests.get(hostname, timeout=2)
        if response.status_code == 204:
            pingstatus = "Network Active"
            status = True
        else:
            pingstatus = "Network Error"
            status = False
            
    except:
         pingstatus = "Network Error"
         status = False
    
    return pingstatus, status
