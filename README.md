# Parts Manager

![screenshot](./screenshot.png)

## Description

This software is a very simple way to manage your (electronic) parts. It supports storage locations and components which are attached to those storage locations. A component entry features multiple specifications like category, datasheet hyperlink, supplier and so on. There's also the feature to have a component countable with a stock value or non countable.

## Installation

You can use this Software with a LAMP Stack, or much easier Docker. For the Docker way you just need to invoke following Docker command:
```
docker run -d -p 80:80 parts_manager
```

## History

I don't even know if it is a good idea to put this piece of software online. I started creating this software in 2015. As a little explanation, I had no idea on how PHP or even Web technologies work back then. So this piece of software is really just a pile of very bad code.

Beginning 2018 I have started implementing a very basic and at least as bad API to this software. I basically just copied over the Database access code from the main software file and added some mode switching via switch-case statement.

End 2018 I want to pull the Raspberry Pi out of service on which this software is running on. My plan is to still run this software on a Docker Container. Thus I had the chance to improve the software agan a little bit during the process of making this software Docker compatible.

Beginning 2019 I finally started to refactor this whole software to the Laravel PHP Framework. With this refactoring the software is now in a usuable state.
