import React from 'react'
import { logout } from '../Api/api'
import { useEffect } from 'react'
import { Link, Navigate, useNavigate } from 'react-router-dom';

export const Logout = () => {
    const navigate = useNavigate();
    useEffect(() => {
        logout().then((data)=>{
            console.log(data['Msg']);
            //navigate("/");
            window.location.reload();
        });
    },[]);

  return (
    <div>logout</div>
  )
}

export default Logout;
