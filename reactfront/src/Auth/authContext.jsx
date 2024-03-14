import { createContext, useContext, useState, useEffect } from 'react';
import Cookies from 'js-cookie';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {

    const [role, setRole] = useState('');
    const [authenticated, setAuthenticated] = useState(false);
    const [userId, setUserId] = useState('');

    useEffect(() => {
        checkAuthentication();
    }, []);

    const checkAuthentication = () => {
        if (Cookies.get('token') != null) {
            setAuthenticated(true);
            setRole(localStorage.getItem("role"));
            setUserId(localStorage.getItem("user_id")); 
        } else {
            setRole("no role");
        }
    };

    return (
        <AuthContext.Provider value={{ authenticated, role, userId }}> 
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => {
    return useContext(AuthContext);
};