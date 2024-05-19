import React from 'react'
import { logout } from '../Api/api'
import { useEffect } from 'react'

export const Logout = () => {
    useEffect(() => {
        logout().then((data)=>{
            console.log(data['Msg']);
            window.location.reload();
        });
    },[]);

  return (
    <div>
      <h1>Logging you out</h1>
    </div>
  )
}

export default Logout;
