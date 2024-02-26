import React, { useState, useEffect } from 'react';
import { fetchProfiles, approveProfile, rejectProfile, addProfile } from '../Api/api';
import { useAuth } from '../Auth/authContext';

const SuggestProfile = () => {
    const [username, setUsername] = useState('');
    const [successMessage, setSuccessMessage] = useState('');
    const [showModal, setShowModal] = useState(false);
    const [profiles, setProfiles] = useState([]);
    const { token, role, userId } = useAuth(); 

    const handleUsernameChange = (event) => {
        setUsername(event.target.value);
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        try {
            console.log('Username:', username);
            await addProfile(username, userId); 
            setSuccessMessage('Successfully forwarded to admin.');
            setShowModal(true);
            setUsername('');
        } catch (error) {
            console.error('Sending error:', error);
        }
    };

    useEffect(() => {
        const fetchAllProfiles = async () => {
            try {
                const data = await fetchProfiles(token); 
                setProfiles(data);
            } catch (error) {
                console.error('Error fetching profiles:', error);
            }
        };

        fetchAllProfiles();
    }, [token, userId]);

    const handleReject = async (id) => {
        try {
            await rejectProfile(id);
            setProfiles(profiles.filter(profile => profile.id !== id)); 
            console.log('Profile rejected successfully.');
        } catch (error) {
            console.error('Error rejecting profile:', error);
        }
    };

    const handleApprove = async (id) => {
        try {
            await approveProfile(id); 
            setProfiles(prevProfiles => prevProfiles.filter(profile => profile.id !== id));
            console.log('Profile approved successfully.');
        } catch (error) {
            console.error('Error approving profile:', error);
        }
    };

    return (
        <div>
            {role === 'admin' ? (
                <div>
                    <h2>Profile suggestions</h2>
                    {profiles.length > 0 && (
                        <div>
                            <h3>All suggested profiles:</h3>
                            <ul>
                                {profiles
                                    .filter(profile => profile.approval === 0) 
                                    .map(profile => (
                                        <li key={profile.id}>
                                            {profile.username}
                                            <button onClick={() => handleApprove(profile.id)}>Approve</button> 
                                            <button onClick={() => handleReject(profile.id)}>Reject</button>
                                        </li>
                                    ))}
                            </ul>
                        </div>
                    )}
                </div>
            ) : (
                <div>
                    <h2>Profile suggestions</h2>
                    <form onSubmit={handleSubmit}>
                        <label>
                            Username:
                            <input
                                type="text"
                                value={username}
                                onChange={handleUsernameChange}
                                required
                            />
                        </label>
                        <button type="submit">Suggest</button>
                    </form>

                    {showModal && (
                        <div className="modal">
                            <div className="modal-content">
                                <span className="close" onClick={() => setShowModal(false)}>&times;</span>
                                <p>{successMessage}</p>
                            </div>
                        </div>
                    )}
                </div>
            )}
        </div>
    );
};

export default SuggestProfile;
