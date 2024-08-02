from gpio_lcd import GpioLcd
import machine
from machine import Pin, SoftI2C
from lcd_api import LcdApi
from i2c_lcd import I2cLcd
from time import sleep


def printMessage(lcd, message):
     if not lcd:
            print(message)
     else:
         lcd.clear()
         lcd.putstr(message)
            
def get_lcd():
    sdaPIN=machine.Pin(21)
    sclPIN=machine.Pin(22)

    i2c=machine.I2C(sda=sdaPIN, scl=sclPIN, freq=10000)   

    devices = i2c.scan()
    if len(devices) == 0:
        return None
    else:
        I2C_ADDR = 0x27
        totalRows = 2
        totalColumns = 16

        i2c = SoftI2C(scl=Pin(22), sda=Pin(21), freq=10000)

        lcd = I2cLcd(i2c, I2C_ADDR, totalRows, totalColumns)
        
        return lcd