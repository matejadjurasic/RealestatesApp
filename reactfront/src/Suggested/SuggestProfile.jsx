import React, { useState, useEffect } from 'react';
import { fetchProfiles, approveProfile, rejectProfile, addProfile } from '../Api/api';
import { useAuth } from '../Auth/authContext';
import './suggestprofile.css';

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
        <div className="suggest-profile">
            <h2 className="suggest-profile-header">Profile suggestions</h2>
            {role === 'admin' ? (
                <div className="suggest-profile-cards">
                    {profiles.length > 0 && profiles
                        .filter(profile => profile.approval === 0) 
                        .map(profile => (
                            <div key={profile.id} className="suggest-profile-card">
                                <h3 className="suggest-profile-card-username">{profile.username}</h3>
                                <div className="suggest-profile-buttons">
                                    <button className="suggest-profile-approve-btn" onClick={() => handleApprove(profile.id)}>Approve</button> 
                                    <button className="suggest-profile-reject-btn" onClick={() => handleReject(profile.id)}>Reject</button>
                                </div>
                            </div>
                        ))}
                </div>
            ) : (
                <div className="suggest-profile-form-container">
                    <form className="suggest-profile-form" onSubmit={handleSubmit}>
                        <label>
                            <input
                                type="text"
                                placeholder="Enter username"
                                value={username}
                                onChange={handleUsernameChange}
                                required
                                className="suggest-profile-username-input"
                            />
                        </label>
                        <button type="submit" className="suggest-profile-suggest-btn">Suggest</button>
                    </form>
                    {showModal && (
                        <div className="suggest-profile-modal">
                            <div className="suggest-profile-modal-content">
                                <span className="suggest-profile-close" onClick={() => setShowModal(false)}>&times;</span>
                                <p className="suggest-profile-success-message">{successMessage}</p>
                            </div>
                        </div>
                    )}
                </div>
            )}
        </div>
    );
};

export default SuggestProfile;
