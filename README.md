
<!-- PROJECT SHIELDS -->
[![Build Status][build-shield]]()
[![Contributors][contributors-shield]]()
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

        
        
<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="https://i.imgur.com/aIfzI2y.png" alt="Logo" width="370" height="300">
  </a>

  <h3 align="center">Fitness Up</h3>

  <p align="center">
    A Fitness Web App - Coming Soon
    <br />
    <a href="https://github.com/renwid/fitnessApp"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/renwid/fitnessApp">View Demo</a>
    ·
    <a href="https://github.com/renwid/fitnessApp">Report Bug</a>
    ·
    <a href="https://github.com/renwid/fitnessApp">Request Feature</a>
  </p>
</p>


<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Database](#database)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)

<!-- ABOUT THE PROJECT -->
## About The Project

[![FitnessUp Page][product-screenshot]](https://i.imgur.com/JDSKgSl.png)

> “Strength does not come from the physical capacity. It comes from an indomitable will.”– Ghandi

FitnessUp is a collaborative website made by Renzo and Boshi with aims to provide CRUD functionality to the users all while maintaining an aesthetically pleasing interface. This website aims to be utilized as a way to store food informations, and allowing users to access that stored information to calculate the total calories of their food.

The website is fully equiped with a bunch of amazing features: A functional login / signup page enchanced with email verification, forgot password feature as well as a personalized homepage for each user. 

In addition we make sure that we are delivering the best design possible, one example is our customized login page with canvas and AJAX as the validator 

![GIF](https://i.gyazo.com/76431a3bd26d74f302e53314dbaa2824.gif)

***

 [![Validator][validator-screenshot]](https://i.imgur.com/gP2IU2R.png)

### Database

This website depends on all **8** tables in the fitnessUp database. One of them is the **food** table which we will take a look at below:

|foodID|foodName|foodCategoryID|foodGI|foodGL|foodProtein|foodCarbs|foodFat|foodCalorie|
| ---  | --- | --- | --- | --- | --- | --- | --- | --- | 
|1     |Apple|1    |40   |6    |0.30 |16.60|0.20 |16.00|
|2     |Salmon|4   |20   |15   |20.00|0.00|4.00|127.00 |
|3     |Banana|1   |47   |11   |1.20|27.60|0.40|24.00 |

### Built With
This section should list any major frameworks that you built your project using. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)
* [Laravel](https://laravel.com)



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* npm
```sh
npm install npm@latest -g
```


<!-- MARKDOWN LINKS & IMAGES -->
[build-shield]: https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat-square
[contributors-shield]: https://img.shields.io/badge/contributors-2-orange.svg?style=flat-square
[license-shield]: https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square
[license-url]: https://choosealicense.com/licenses/mit
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/othneildrew
[product-screenshot]: https://i.imgur.com/JDSKgSl.png
[validator-screenshot]: https://i.imgur.com/gP2IU2R.png
