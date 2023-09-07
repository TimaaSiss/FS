import React from 'react';
import { View, Text, StyleSheet } from 'react-native';
import { useDispatch } from 'react-redux';
import { logoutUser } from './userSlice';



const Deconnexion = (props) => {
  const dispatch = useDispatch();

  const handleLogout = () => {
    dispatch(logoutUser());
    // Naviguez vers la page de connexion après la déconnexion
    props.navigation.navigate('SignUp'); // Utilisez "replace" pour éviter d'empiler les écrans
  };

  return (
    <View style={styles.container}>
      <Text style={styles.text}>Déconnexion en cours...</Text>
      {/* Vous pouvez afficher un spinner ou un message pendant la déconnexion */}
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  text: {
    fontSize: 18,
  },
});

export default Deconnexion;
