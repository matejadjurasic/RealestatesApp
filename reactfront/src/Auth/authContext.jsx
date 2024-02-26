import { createContext, useContext, useState, useEffect } from 'react';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {

    const [role, setRole] = useState('');
    const [authenticated, setAuthenticated] = useState(false);
    const [userId, setUserId] = useState('');

    useEffect(() => {
        checkAuthentication();
    }, []);

    const checkAuthentication = () => {
        if (localStorage.getItem("token")) {
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