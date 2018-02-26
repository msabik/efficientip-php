# remove_default_gateway.php
## This simple php script monitors and removes system default gateway from EfficientIP SolidServer product

I encountered a challenge where it was necessary to learn default route from dynamic routing (bgb, ospf). Due to the EfficientIP product design it's not possible to skip the default gateway from the configuration and it tends to come back when administrator is changing network configuration using GUI. 

This php rule will register into the product. Scheduled job will be monitoring default gateway status for any changes every minute and delete the gateway if it determintes it's static. Along the gateway action all associated hooked services (in my case quagga and dns engine) are restarted.

HOW TO INSTALL:
Copy the php file to /data1/share/php_service/
Then go to the GUI of EfficientIP>Administration>System>Expert>Register new macros and rules
