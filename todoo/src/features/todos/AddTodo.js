import React, { useState} from "react";
import { View, StyleSheet, Text, TextInput, TouchableOpacity} from "react-native";
import { useDispatch } from "react-redux";
import { addTodo } from "./todosSlice";

export const  Addtodo= ()=> {
    const [text, setText]= useState();
    const dispatch= useDispatch();

    function handleSubmit() {
        if(!text) return;
        dispatch(addTodo(text));
        setText('');
    }

    return(
        <View style={styles.container}>
            <Text style= {styles.class}>Vous Pouvez Ajouter vos taches Ici!</Text>
            <TextInput
            placeholder="Todo"
            value={text}
            onChangeText={setText}
            style={styles.input}/>
          <TouchableOpacity
                style={[styles.button, styles.editButton]}
                onPress={() => handleSubmit()} // Mettre la tâche en mode édition
              >
                <Text style={styles.buttonText}>Add Task</Text>
              </TouchableOpacity>
        </View>
    );
};

const styles= StyleSheet.create({
    container: {
        marginVertical:2,
        marginTop:2,
        marginBottom:35,
        width: "100%",
    },
    input: {
        height:30,
        marginBottom:15,
        backgroundColor: 'ghostwhite',
    },
    class:{
        fontSize: 24,
        fontWeight: 'bold',  
    },
      button: {
        padding: 10,
        borderRadius: 20,
        marginHorizontal: 10,
      },
      editButton: {
        backgroundColor: "#3498db",
      },
      buttonText: {
        color: "#fff",
      },
})