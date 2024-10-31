<?php

require("models/categories.php");


    $model = new Categories();

        
    $categories = $model->getAll();

        
require("views/categories.php");