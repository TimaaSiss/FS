import React, { useState } from 'react';
import { View, Text, TextInput, Button, StyleSheet, Alert } from 'react-native';
import { useDispatch, useSelector } from 'react-redux';
import { setUser } from '../userSlice';
import axios from 'axios'; // Importez Axios

const UpdateUser = () => {
  const dispatch = useDispatch();
  const currentUser = useSelector((state) => state.user);

  const [newUsername, setNewUsername] = useState(currentUser.username);
  const [newEmail, setNewEmail] = useState(currentUser.email);
  const [newPassword, setNewPassword] = useState('');
  const [updateSuccess, setUpdateSuccess] = useState(false);

  const handleUpdate = async () => {
    try {
      const response = await axios.put(
        "http://localhost/todo/apis/user", // URL de votre API de mise à jour d'utilisateur
        {
          userId: currentUser.userId,
          username: newUsername,
          email: newEmail,
          password: newPassword,
        }
      );

      if (response.status === 200) {
        // Mise à jour réussie, mettez à jour les informations dans le store Redux
        dispatch(setUser({
          username: newUsername,
          email: newEmail,
        }));
        setUpdateSuccess(true);
        // Réinitialisez le champ du mot de passe après la mise à jour
        setNewPassword('');
      } else {
        Alert.alert("Échec de la mise à jour", "Une erreur s'est produite lors de la mise à jour des informations.");
      }
    } catch (error) {
      console.error("Une erreur s'est produite lors de la mise à jour :", error);
      Alert.alert("Erreur", "Une erreur s'est produite lors de la mise à jour des informations.");
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Modifier les informations</Text>
      <TextInput
        style={styles.input}
        placeholder="Nouveau Nom d'utilisateur"
        value={newUsername}
        onChangeText={setNewUsername}
      />
      <TextInput
        style={styles.input}
        placeholder="Nouveau Email"
        value={newEmail}
        onChangeText={setNewEmail}
      />
      <TextInput
        style={styles.input}
        placeholder="Nouveau Mot de Passe"
        secureTextEntry
        value={newPassword}
        onChangeText={setNewPassword}
      />
      <Button title="Mettre à Jour" onPress={handleUpdate} style={styles.updateButton} />
      {updateSuccess && (
        <Text style={styles.successText}>Les informations ont été mises à jour avec succès!</Text>
      )}
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 20,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 5,
    padding: 10,
    marginBottom: 15,
  },
  successText: {
    color: 'green',
    marginTop: 10,
  },
  updateButton: {
    backgroundColor: '#3498db',
    padding: 10,
    borderRadius: 5,
    alignSelf: 'center',
    marginTop: 20,
  },
});

export default UpdateUser;
