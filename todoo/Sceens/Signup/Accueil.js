import React from 'react';
import { View, Text, Image, StyleSheet, Button, ScrollView, TouchableWithoutFeedback, Keyboard} from 'react-native';


const Accueil = (props) => {

  return (
    <ScrollView
    contentContainerStyle={styles.scrollContainer}
    keyboardShouldPersistTaps="handled">
    <TouchableWithoutFeedback onPress={Keyboard.dismiss}>
    <View style={styles.container}>
      <Text style={styles.logo}>My To-Do List</Text>
      <Text>Bienvenue!</Text>
      <Text>Vous pouvez gérer vos tâches ici.</Text>

      <Button
            title="Inscrivez-vous"
            onPress={() => props.navigation.navigate('Inscription')}
          />
          <Text>Ou si vous possedez déjà un compte </Text>
          <Button
            title="Connectez-vous"
            onPress={() => props.navigation.navigate('Connexion')}
          />

      <View style={styles.featureContainer}>
        <View style={styles.feature}>
          <Image source={require('../assets/projet.png')} style={styles.image} />
          <Text>
            Vous avez un projet d'équipe à gérer et vous êtes chargé en ne sachant pas comment vous organiser ?
            Ne vous en faites pas, notre application mobile est là pour vous!
          </Text>
        </View>

        <View style={styles.feature}>
          <Image source={require('../assets/work.jpg')} style={styles.image} />
          <Text>
            Avec ma to do list, peu importe le nombre de tâches, n'ayez crainte, vous pourrez faire un check de toutes les tâches
            et les notes également pour éviter de vous perdre.
          </Text>
        </View>

        <View style={styles.feature}>
          <Image source={require('../assets/task.webp')} style={styles.image} />
          <Text>
            Nous vous offrons un profil bien aménagé et organisé qui vous permettra de noter vos tâches de la plus importante
            à la moins importante, de la plus compliquée à la moins difficile et ainsi de suite.
            Finies les prises de tête pour bien gérer toutes vos tâches
          </Text>
        </View>
      </View>
    </View>
    </TouchableWithoutFeedback>
    </ScrollView>
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
  featureContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 30,
  },
  feature: {
    flex: 1,
    margin: 10,
  },
  image: {
    width: '100%',
    height: 200, // Ajustez la hauteur comme nécessaire
    borderRadius: 5,
    objectFit:"cover"
  },
  button: {
    backgroundColor: '#b5e2ff',
    padding: 15,
    borderRadius: 5,
  },
  scrollContainer: {
    flex: 1,
  },

});

export default Accueil;
