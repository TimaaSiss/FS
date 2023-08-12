import React from 'react';
import { View, Text, StyleSheet } from 'react-native';
import { useSelector } from 'react-redux'; // Importez le hook useSelector

const Accueil = () => {
  // Utilisez useSelector pour obtenir les données de l'utilisateur depuis Redux
  const user = useSelector(state => state.user);

  return (
    <View style={styles.container}>
      <Text style={styles.logo}>My To-Do List</Text>
      <Text>Bienvenue, {user.username}!</Text>
      <Text>Vous pouvez gérer vos tâches ici.</Text>
      {/* Ajoutez d'autres éléments de contenu ici */}
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f2f2f2',
    padding: 20,
  },
  logo: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#fd6c9e',
    marginBottom: 20,
  },
});

export default Accueil;
