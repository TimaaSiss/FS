import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';
import { useSelector, useDispatch } from 'react-redux';
import { logoutUser } from './userSlice';


const Profile = ({ navigation }) => {
  const userInfo = useSelector((state) => state.user);
  const dispatch = useDispatch();

  const handleLogout = () => {
    // Dispatch de l'action de déconnexion pour réinitialiser les données de l'utilisateur
    dispatch(logoutUser());

    // Naviguer vers la page de connexion
    navigation.navigate('Connexion');
  };

    return (
      <View style={styles.container}>
        <Text style={styles.heading}>Profil Utilisateur</Text>
        <Text>Nom d'utilisateur: {userInfo.username}</Text>
        <Text>Adresse e-mail: {userInfo.email}</Text>
        
      
  
        <TouchableOpacity
          style={styles.button}
          onPress={() => navigation.navigate('updateUser')} // Naviguer vers la page de changement de mot de passe
        >
          <Text style={styles.buttonText}>Modifier les informations de l'utilisateur</Text>
        </TouchableOpacity>

        <TouchableOpacity
          style={styles.button}
          onPress={() => navigation.navigate('TodoList')} // Naviguer vers l'historique des tâches
        >
          <Text style={styles.buttonText}>Liste des tâches</Text>
        </TouchableOpacity>
  
        <TouchableOpacity
          style={styles.button}
          onPress={() => navigation.navigate('Historique')} // Naviguer vers l'historique des tâches
        >
          <Text style={styles.buttonText}>Historique des tâches</Text>
        </TouchableOpacity>
  
        <TouchableOpacity
          style={styles.button}
          onPress={() => navigation.navigate('Connexion')} // Naviguer vers la page de déconnexion
        >
          <Text style={styles.buttonText}>Déconnexion</Text>
        </TouchableOpacity>
      </View>
    );
  };
  
  export default Profile;
  
  const styles = StyleSheet.create({
    container: {
      flex: 1,
      justifyContent: 'center',
      alignItems: 'center',
      padding: 20,
    },
    heading: {
      fontSize: 24,
      fontWeight: 'bold',
      marginBottom: 20,
    },
    button: {
      backgroundColor: '#b5e2ff',
      padding: 15,
      borderRadius: 5,
      marginBottom: 10,
      width: '100%',
      alignItems: 'center',
    },
    buttonText: {
      color: '#fff',
    },
  });
  