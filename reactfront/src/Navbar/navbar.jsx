import React, {useState,useContext} from 'react';
import './navbar.css'; 
import Login from '../Login/login';
import {AuthContext} from '../Auth/authContext';
import { useAuth } from '../Auth/authContext';
//import {user} from '../Login/login';
import Logout from '../Logout/logout';
import { Link } from "react-router-dom";


const Navbar = () => {

    const {authenticated,role} = useAuth();

    const menu = document.querySelector('.navbar_togglemenu');
    const menuLinks = document.querySelector('.navList');

    const handleClick = () =>{
      menu.classList.toggle('is-active');
      menuLinks.classList.toggle('active');
    }
     
    return (
        <nav className="navbar">
          <div className='logo'>
            <img src={require('../img/logo.png')} className='logoimage' />
          </div>
          
          <div className="navbar_togglemenu" onClick={handleClick} >
            <span className="bar"></span>
            <span className="bar"></span>
            <span className="bar"></span>
          </div>
          <ul className="navList">
            {authenticated ? (
                <>
                  <Link to="/">Home</Link>
                  <Link to="/favorites">Favorites</Link>
                  <Link to="/suggest-profile">Suggest Profile</Link>
                  {role === 'admin' && <Link to="/addrealestate">Add</Link>}
                  <Link to="/myprofile">My profile</Link>
                  <Link to="/logout" style={{ color: "yellow" }}>Logout</Link>
                </>
              ) : (
                <>
                  <Link to="/">Home</Link>
                  <Link to="/login">Login</Link>
                  <Link to="/register">Register</Link>
                </>
              )
            }
          </ul>
        </nav>
      );
}

export default Navbar;
