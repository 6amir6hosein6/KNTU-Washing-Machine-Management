from machine import Pin
from time import sleep
import utime
from gpio_lcd import GpioLcd

ROW_PINS = [27, 14, 12, 13]  
COL_PINS = [33, 34, 35]

KEY_MAP = [["1", "2", "3"],\
      ["4", "5", "6"],\
      ["7", "8", "9"],\
      ["*", "0", "#"]]

pressed = [False,False,False,False]

def read_key(rows = ROW_PINS, columns = COL_PINS):
    for index, row in enumerate(rows):
        row.value(1)
        result = [columns[i].value() for i in range(len(columns))]
        row.value(0)
        global pressed
        if max(result) == 1:
            if not pressed[index]:
                pressed[index] = True
                key = KEY_MAP[int(index)][int(result.index(1))]
                print("clicked : " + key)
                return key
        else:
            if pressed[index]:
                pressed[index] = False
            
    return None


for x in range(0, 4):
    ROW_PINS[x] = Pin(ROW_PINS[x], Pin.OUT)
    ROW_PINS[x].value(0)

for x in range(0, 3):
    COL_PINS[x] = Pin(COL_PINS[x], Pin.IN, Pin.PULL_DOWN)






  