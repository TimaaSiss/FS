import React, { useEffect, useState } from 'react';
import {Text, TextInput, TouchableWithoutFeedback, TouchableOpacity, View, StyleSheet, ScrollView, Keyboard, Button, Alert } from 'react-native';
import layouts from '../../constantes/layouts';
import { useDispatch } from 'react-redux';
import { updateUser } from '../userSlice';
import api  from '../../constantes';

const SignUp = (props) => {

  const [email, setEmail] = useState('kadi@yahoo.fr');
  const [password, setPassword] = useState('djetou');
  const [errorMessage, setErrorMessage] = useState('');

  const dispatch = useDispatch();

  const handleLogin = async () => {
    try {
      if (email === '' || password === '') {
        setErrorMessage('Veuillez remplir tous les champs pour vous connecter.');
        Alert.alert('Alert', 'Veuillez remplir tous les champs pour vous connecter.');
        return;
      }

      // Envoyer la demande de connexion à l'API
      const response = await api.post("/user/api-connect-user.php", {
        mailconnect: email,
        mdpconnect: password,
      });

      console.log(JSON.stringify(response.data)); 

      if (response.data.status == 200) {
        // Connexion réussie, effectuez les actions nécessaires
        setErrorMessage('');
        console.log('Connexion réussie');
  
        // Dispatch de l'action pour mettre à jour les informations de l'utilisateur
        dispatch(updateUser({ username: response.data.username, email: response.data.email, jwt : response.data.jwt }));
  
        // Vous pouvez également naviguer vers une autre page si la connexion est réussie
        props.navigation.navigate('Profile');
      } else {
        // Connexion échouée
        setErrorMessage('Les informations d\'identification sont incorrectes.');
        console.log('Connexion échouée');
      }
    } catch (error) {
      console.error("Une erreur s'est produite :", error);
    }
  };
  

  return (
    <ScrollView
      contentContainerStyle={style.scrollContainer}
      keyboardShouldPersistTaps="handled">
      <TouchableWithoutFeedback onPress={Keyboard.dismiss}>
        <View style={style.root}>
          <Text style={style.titre}>CONNEXION </Text>
          <View style={style.input_group}>
            <Text style={style.text}>Votre Email:</Text>
            <View style={style.input_container}>
              <TextInput
                secureTextEntry={false}
                placeholder="Votre Email"
                value={email}
                onChangeText={setEmail}
              />
            </View>
            <View>
              <Text style={style.text}>Votre Mot de Passe:</Text>
              <View style={style.input_container}>
                <TextInput
                  secureTextEntry={true}
                  placeholder="Votre Mot de Passe"
                  value={password}
                  onChangeText={setPassword}
                />
              </View>
            </View>
          </View>
          {errorMessage !== '' && <Text style={style.errorMessage}>{errorMessage}</Text>}


          <TouchableOpacity  style={style.button} onPress={handleLogin}>
            <Text style={[style.text, style.button_text]}>Me connecter</Text>
          </TouchableOpacity>
          <Button
            title="Vous n'avez pas de compte? Inscrivez-vous!"
            onPress={() => props.navigation.navigate('Inscription')}
          />
        </View>
      </TouchableWithoutFeedback>
    </ScrollView>
  );
};

export default SignUp;

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
  errorMessage: {
    color: 'red',
    fontSize: 16,
    marginTop: 10,
    textAlign: 'center',
  },
  
});
