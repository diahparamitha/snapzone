import './bootstrap';

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken, onMessage } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyA6SUCOe9tqxOgmnybQCFTqNLozC7ZXN3w",
  authDomain: "invoiceib.firebaseapp.com",
  projectId: "invoiceib",
  storageBucket: "invoiceib.appspot.com",
  messagingSenderId: "386515053539",
  appId: "1:386515053539:web:e76cb85fefb86b7dd78ed6",
  measurementId: "G-R9SGRLXEBF"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);

onMessage(messaging, (payload) => {
  console.log('Message received. ', payload);
  alert('wow');
});

getToken(messaging, { vapidKey: 'BJ_q3bPBni6RGMg-xslVtCJPPculSK-dRy2gHb0931JMPAir4olJqmJvyuApLf2fyMwHNjKRgNX61SMUVqHw-qk', })
  .then((currentToken) => {
    if (currentToken) {
      // Send the token to your server and update the UI if necessary
      console.log(currentToken);
    } else {
      // Show permission request UI
      requestPermission();
      console.log('No registration token available. Request permission to generate one.');
      // ...
    }
  }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
  });

function requestPermission(){
  Notification.requestPermission().then((permission) => {
    if (permission === 'granted') {
      console.log('Notification permission granted.');
      // TODO(developer): Retrieve a registration token for use with FCM.
      alert('tes bisa');
    } else {
      alert('Tes');
    }
  });
}