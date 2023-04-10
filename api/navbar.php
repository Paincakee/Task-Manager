<?php

session_start();


function navbar(){
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        ?>
        <nav id="navbar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#">Agenda</a></li>
            <li><a href="task.php">Tasks</a></li>
            <li><a href="#">Settings</a></li>
            <li><a id="logout-btn">Logout</a></li>
        </ul>
        </nav>
        <?php
    }
    else {
        ?>
        <nav id="navbar">
            <ul>
                <li><a href="register.php">Create Account</a></li>
                <li><a href="login.php">Log In</a></li>
            </ul>
        </nav>
        <?php
    }
}