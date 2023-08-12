import * as React from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import SignUp from './Sceens/Signup/SignUp';
import Inscription from './Sceens/Signup/Inscription';
import Profile from './Sceens/Profile';
import Accueil from './Sceens/Signup/Accueil';
import { Provider } from "react-redux";
import { store } from "./src/features/Store";
import { TodoList } from "./src/features/todos/TodoList";


const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <Provider store={store}> 
    <NavigationContainer>
      <Stack.Navigator>
         <Stack.Screen name="Connexion" component={SignUp} />
        <Stack.Screen name="Inscription" component={Inscription} />
        <Stack.Screen name="Profile" component={Profile} />
        <Stack.Screen name="Accueil" component={Accueil} />
        <Stack.Screen name="TodoList" component={TodoList} />
      
        
      </Stack.Navigator>
    </NavigationContainer>
    </Provider>
  );
}

