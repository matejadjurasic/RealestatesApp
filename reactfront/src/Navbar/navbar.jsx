import React, {useRef} from 'react';
import './navbar.css'; 
import { useAuth } from '../Auth/authContext';
import { Link } from "react-router-dom";


const Navbar = () => {

    const {authenticated,role} = useAuth();
    //used to safely access elements to avoid null pointer exceptions
    const menuRef = useRef(null);
    const menuLinksRef = useRef(null);

    //toggles the navbar active classes
    const handleClick = () =>{
      if (menuRef.current && menuLinksRef.current) {
        menuRef.current.classList.toggle('is-active');
        menuLinksRef.current.classList.toggle('active');
      }
    }
     
    return (
        <nav className="navbar">
          <div className='logo'>
            <img src={require('../img/logo.png')} className='logoimage' />
          </div>
          
          <div className="navbar_togglemenu" onClick={handleClick} ref={menuRef}>
            <span className="bar"></span>
            <span className="bar"></span>
            <span className="bar"></span>
          </div>
          <ul className="navList" onClick={handleClick} ref={menuLinksRef}>
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
