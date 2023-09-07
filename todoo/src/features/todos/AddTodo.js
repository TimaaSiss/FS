import React, { useState } from "react";
import {
  View,
  StyleSheet,
  Text,
  TextInput,
  TouchableOpacity,
} from "react-native";
import { useDispatch, useSelector } from "react-redux";
import { addTodo } from "./todosSlice";
import api from "../../../constantes";

export const Addtodo = () => {
  const [text, setText] = useState();
  const jwtToken = useSelector((state) => state.user.jwt);

  const dispatch = useDispatch();

  const handleSubmit = async () => {
    try {
      if (!text) return;
      const response = await api.post(
        "/task/api-create-task.php",
        {
          task_name: text,
          status: "", // Vous pouvez définir le statut initial ici si nécessaire
        },
        {
          headers: {
            Authorization: `Bearer ${jwtToken}`, // Utiliser le token JWT dans l'en-tête
          },
        }
      );

      if (response.data.status === 200) {
        const todo = response.data.todo; // Renommez la variable en newTodo
        // dispatch
        dispatch(addTodo({
          id : todo.id,
          text:todo.text
        }));
        setText("");
      } else {
        console.log("Échec de l'ajout de la tâche");
      }
    } catch (error) {
      console.error("Une erreur s'est produite lors de l'ajout :", error);
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.class}>Vous Pouvez Ajouter vos taches Ici!</Text>
      <TextInput
        placeholder="Todo"
        value={text}
        onChangeText={setText}
        style={styles.input}
      />
      <TouchableOpacity
        style={[styles.button, styles.editButton]}
        onPress={() => handleSubmit()} // Mettre la tâche en mode édition
      >
        <Text style={styles.buttonText}>Add Task</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    marginVertical: 2,
    marginTop: 2,
    marginBottom: 35,
    width: "100%",
  },
  input: {
    height: 30,
    marginBottom: 15,
    backgroundColor: "ghostwhite",
  },
  class: {
    fontSize: 24,
    fontWeight: "bold",
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
});
