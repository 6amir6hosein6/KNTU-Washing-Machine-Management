from machine import Pin
from time import sleep

relays = {
    'QD-3DAN6' : {'pin' : Pin(26, Pin.OUT) , 'endAt' : 0},
    'QD-RTK79' : {'pin' : Pin(27, Pin.OUT) , 'endAt' : 0},
}

for item in relays.values():
    item['pin'].on()

def turn_off(relay_code):
    relays[relay_code]['pin'].on()
    
def turn_on(relay_code):
    relays[relay_code]['pin'].off()
    
def set_endAt(relay_code, endAt):
    relays[relay_code]['endAt'] = endAt
    
def turn_of_ended_relays(current):
    for relay in relays.values():
        if relay['endAt'] < current:
            relay['pin'].on()
            
def test():
    for relay in relays.values():
        relay['pin'].off()
    
    sleep(1.5)