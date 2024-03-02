import React,{useState,useEffect} from 'react'
import { getUser } from '../Api/api';
import { reset } from '../Api/api';

export const User = () => {

    const [user, setUser] = useState([]);
    const [newPassword, setNewPassword] = useState('');
    const [successMessage, setSuccessMessage] = useState('');

    useEffect(()=>{
        const fetchUser = async () => {
          try {
            getUser().then((data) => {
                setUser(data);
                
            });
            
          } catch (error) {
            console.error('Error fetching estate:', error);
          }
        };
        
        fetchUser();   
    },[]);

    const resetPassword = async () => {
        try {
          reset(user['email'],newPassword).then((data) => {
              setSuccessMessage('Uspesna promena');
              setNewPassword('');
          });
        } catch (error) {
          console.error('Error fetching estate:', error);
          setSuccessMessage('Neuspesna promena');
        }
    };


  return (
    <div>
        <h1>My profile</h1>
        <p>Username:{user['name']}</p>
        <p>email:{user['email']}</p>
        <input
        type="text"
        placeholder="Set new password..."
        value={newPassword}
        onChange={(e) => setNewPassword(e.target.value)}
        />
        <button onClick={resetPassword}>Reset Password</button>
        <p>{successMessage}</p>
    </div>
  )
}

export default User;