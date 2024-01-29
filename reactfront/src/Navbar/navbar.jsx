import React, {useState,useContext} from 'react';
import './navbar.css'; 
import Login from '../Login/login';
import '../Auth/authContext';
import { useAuth } from '../Auth/authContext';

const Navbar = () => {

    
    const {authenticated,role,name} = useAuth();

    return (
        <nav className="navbar">
          <ul className="navList">
            <li className="navItem"><a href="/" className="navLink">Home</a></li>
            <li className="navItem"><a href="/about" className="navLink">About</a></li>
            <li className="navItem"><a href="/contact" className="navLink">Name: {name}</a></li>
            {name && <li>Welcome, {name}!</li>}
          </ul>
        </nav>
      );
}

export default Navbar;
