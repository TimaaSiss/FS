import React, { useState } from 'react';
import { Text, TextInput, TouchableOpacity, TouchableWithoutFeedback, ScrollView, Keyboard, View, StyleSheet } from 'react-native';
import { useDispatch } from 'react-redux';
import { updateUser } from '../userSlice';
import layouts from '../../constantes/layouts';
import api from '../../constantes';

const Inscription = (props) => {
  const [email, setEmail] = useState('');
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');

  const dispatch = useDispatch();

  const handleSignup = async () => {
    if (!email || !username || !password) {
      alert("Veuillez remplir tous les champs.");
      return;
    }

    try {
      const response = await api.post("/user/api-create-user.php", {
        mail: email,
        username: username,
        motdepasse: password,
      });

      console.log(JSON.stringify(response.data)); 

      if (response.data.status === 200) {
        // Inscription réussie, mettre à jour les informations de l'utilisateur et rediriger
        dispatch(updateUser({ username: username, email: email, jwt: response.data.jwt }));
        props.navigation.navigate('Connexion');
      } else {
        // Gérer les erreurs d'inscription ici
        alert("Une erreur s'est produite lors de l'inscription.");
      }
    } catch (error) {
      // Gérer les erreurs d'API ici
      console.log("Erreur de connexion à l'API :", error);
      alert("Une erreur s'est produite lors de l'inscription.");
    }
  };

  return (
    <ScrollView
      contentContainerStyle={style.scrollContainer}
      keyboardShouldPersistTaps="handled">
      <TouchableWithoutFeedback onPress={Keyboard.dismiss}>
        <View style={style.root}>
          <Text style={style.titre}>Inscription</Text>
          <View style={style.input_group}>
            <Text style={style.text}>Votre Email:</Text>
            <View style={[style.input_container, !email && style.required_input]}>
              <TextInput
                secureTextEntry={false}
                placeholder="Votre Email"
                value={email}
                onChangeText={setEmail}
              />
            </View>

            <View>
              <Text style={style.text}>Votre Nom d'utilisateur:</Text>
              <View style={[style.input_container, !username && style.required_input]}>
                <TextInput
                  secureTextEntry={false}
                  placeholder="Username"
                  value={username}
                  onChangeText={setUsername}
                />
              </View>
            </View>

            <View>
              <Text style={style.text}>Votre Mot de Passe:</Text>
              <View style={[style.input_container, !password && style.required_input]}>
                <TextInput
                  secureTextEntry={false}
                  placeholder="Votre Mot de Passe"
                  value={password}
                  onChangeText={setPassword}
                />
              </View>
            </View>
          </View>

          <TouchableOpacity style={style.button} onPress={handleSignup}>
            <Text style={[style.text, style.button_text]}>M'inscrire</Text>
          </TouchableOpacity>
        </View>
      </TouchableWithoutFeedback>

    </ScrollView>
  );
};

export default Inscription;

const style = StyleSheet.create({
  root: {
    flex: 1,
    justifyContent: 'center',
    paddingHorizontal: layouts.paddingHorizontal,
    paddingVertical: layouts.paddingVertical,
    backgroundColor: layouts.bgcolor,
  },
  input_container: {
    borderWidth: 1,
    borderColor: layouts.primary,
    borderRadius: 5,
    marginTop: 10,
    marginBottom: 10,
    paddingHorizontal: 10,
    paddingVertical: 10,
    backgroundColor: '#fff',
  },

  input: {
    padding: 10,
  },
  text: {
    fontSize: 16,
  },
  button: {
    backgroundColor: '#b5e2ff',
    padding: 15,
    borderRadius: 5,
  },
  button_text: {
    textAlign: 'center',
    color: '#fff',
  },
  input_group: {
    marginBottom: 10,
  },
  titre: {
    fontSize: 30,
    textAlign: 'center',
  },
  scrollContainer: {
    flex: 1,
  },
  required_input: {
    borderColor: 'red',
  },
});
