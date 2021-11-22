# MowersController
Technical Challenge for SEAT:CODE

## How to Run the project
This project run under docker environment, so you need docker installed and a computer with Linux based SO
For start the project you only run two make commands:

    make install
And

    make run
It's simple!

For the input of the program there is a file that you can edit with the specifications of them. The file is in the:

> *data*

directory and the name is:

> input_data.txt

When you run the project, you read this file directly and see the results. If you have some error on the format you can see it on the console.

If you want to run the test, it's simple too! run this:

    make test

## About the project
On first time I'm go with a simple "kata" project, but I'm unhappy with the results because have a lot of ifs and switch smell codes. So I prefer to invest more time to make better architecture and code. At first, I invested about 4 hours as stated in the documentation luckily I had the afternoon free, and I was able to invest some more.

### MVP
For the first minimum I made only one use case, I had planned to do another command which was guiding you through the process, and I was even painting you a small map which you could visualize in each step, perhaps with that I would have exempted myself.

### Next features
- New menu system
- Render map on console
- Backward movement! (also implement)
- Multiple mowers on field
- Avoid collisions
  
This is only what I had in mind but that due to time issues I have not been able to implement (although I would like to!)

### Why PHP
In principle, when I saw the theme of the test, I was going to try to make it visually more attractive and even do a little challenge with myself and do it in C # with Unity3D since it is one of the things that I usually fiddle with. The problem came in that to execute and distribute such a thing it might have been more cumbersome and even worse since it did not even come close to the specifications. That is why I directly used what I do in my day-to-day life, and I control it perfectly. The project is completely from scratch, both infrastructure and the code itself.

### About Testing
Unfortunately I have not had time to do a complete test battery, although the code is used in a greater part with the main services and it is possible that using as I do in them there is a coverage in conditions since there is hardly any class mockup.

#### Tip
If you uncomment the line 24 and 27 of
> \MowersController\Domain\Service\RotateOrMoveMowerService

You can see the render field of the positions changes of the mower only for debug purposes, of course!

## Author
Code made by: Jafet Juan López Rodríguez

Email: lopezrodriguezjj@gmail.com