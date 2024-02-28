import React,{useState,useEffect} from 'react'
import { useLocation } from 'react-router-dom';
import { showRealEstate } from '../Api/api';
import { MapContainer,TileLayer } from 'react-leaflet';
import { getCoordinates } from '../Api/api';
import 'leaflet/dist/leaflet.css'
import './realEstates.css'

export const ShowEstate = () => {

    const [estate, setEstate] = useState([]);
    const [lon, setLon] = useState(null);
    const [lat, setLat] = useState(null);
    const location = useLocation();
    const queryParams = new URLSearchParams(location.search);

    const id = queryParams.get('id');

    useEffect(()=>{
        const fetchRealEstate = async () => {
          try {
            showRealEstate(id).then((data) => {
                setEstate(data);
            });
          } catch (error) {
            console.error('Error fetching estate:', error);
          }
        };
        
        fetchRealEstate();  
        
    },[id]);

    const fetchCoordinates = async () => {
        try{
            getCoordinates(estate['location']).then((data) => {
            setLon(data[0]['lon'].toFixed(2));
            setLat(data[0]['lat'].toFixed(2));
            
        });
            console.log(lat);
            console.log(lon);
        
        } catch (error) {
            console.error('Error fetching estate:', error);
        }
    }
    useEffect(() => {
        if (estate.length > 0) {
            fetchCoordinates();
        }
    }, [estate]);

    return (
        <div>
            <div>
                <h1>{estate['username']}</h1>
                <img src={estate['profile_picture_url']} alt={`${estate['username']}'s profile`} style={{ maxWidth: '200px' }} />
                <p>Description: {estate['description']}</p>
                <p>Follows: {estate['follows_count']}</p>
                <p>Followers: {estate['followers_count']}</p>
                <p>Price: ${estate['price']}</p>
                <p>Location: {estate['location']}</p>
            </div>
            <div>
                <button onClick={fetchCoordinates}>Dugme</button>
                {lat !== null && lon !== null && (
                    <MapContainer center={[lat, lon]} zoom={13} style={{ height: '400px', width: '100%' }}>
                        <TileLayer
                            attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                        />
                    </MapContainer>
                )}
            </div>
        </div>
    )
}

export default ShowEstate;
