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

    return (
        <nav className="navbar">
          <ul className="navList">
            {authenticated ? (
                <>
                  <Link to="/">Home</Link>
                  <Link to="/logout" style={{ color: "red" }}>Logout</Link>
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
