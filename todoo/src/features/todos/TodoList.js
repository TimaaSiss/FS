import React, { useState, useEffect } from "react";
import { View, StyleSheet, FlatList, Text, TouchableOpacity, TextInput, ScrollView } from "react-native";
import { useSelector, useDispatch } from "react-redux";
import { deleteTodo, editTodo, toggleTodo } from "./todosSlice";
import axios from 'axios'; // Importez Axios
import { Addtodo } from "./AddTodo";
import api from "../../../constantes";

export function TodoList() {
  const todos = useSelector((state) => state.todos);
  const dispatch = useDispatch();
  const jwtToken = useSelector(state => state.jwt);

  const [editingTask, setEditingTask] = useState(null);
  const [editedTaskText, setEditedTaskText] = useState("");
  const [newTodoText, setNewTodoText] = useState("");

  const handleDelete = async (id) => {
    try {
      const Token = jwtToken;
      const response = await api.post('/task/api-delete-task.php', {
        id: id,
      }, {
        headers: {
          'Authorization': `Bearer ${Token}`
        }
      });
  
      if (response.data.message === 'Tâche supprimée avec succès.') {
        dispatch(deleteTodo({ id: id }));
      } else {
        console.log("Échec de la suppression de la tâche");
      }
    } catch (error) {
      console.error('Une erreur s\'est produite lors de la suppression :', error);
    }
  };
  
  
  

  const handleToggle = (id) => {
    dispatch(toggleTodo(id));
  };

  const handleEdit = (id) => {
    const taskToEdit = todos.find((task) => task.id === id);
    setEditingTask(id);
    setEditedTaskText(taskToEdit.task_name);
  };

  

  const handleSaveEdit = async (id) => {
    try {
      const taskToEdit = todos.find((task) => task.id === id);
      const Token = jwtToken;
      const response = await api.post('/task/api-update-task.php', {

        id: id,
        task_name: editedTaskText,
      },{
        headers: {
          'Authorization': `Basic ${Token}` 
        }
      });
  
      if (response.data.status === 200) {
        dispatch(editTodo({ id: id, task_name: editedTaskText, status: taskToEdit.status }));
        setEditingTask(null);
      } else {
        console.log('Échec de la modification de la tâche');
      }
    } catch (error) {
      console.error('Une erreur s\'est produite lors de la modification :', error);
    }
  };
  

  const handleAddTodo = async () => {
    try {
      const Token = jwtToken;
      const response = await api.post('/task/api-create-task.php', {
        task_name: newTodoText,
        status: 'en cours', // Vous pouvez définir le statut initial ici si nécessaire
      }, {
        headers: {
          'Authorization': `Bearer ${Token}`
        }
      });
  
      if (response.data.status === 200) {

        setNewTodoText(''); // Réinitialiser le champ de texte
      } else {
        console.log('Échec de l\'ajout de la tâche');
      }
    } catch (error) {
      console.error('Une erreur s\'est produite lors de l\'ajout :', error);
    }
  };
  

  const fetchUserTasks = async () => {
    try {
      const Token = jwtToken;
      const response = await api.post('/user/api-select-user-tasks.php', {
        headers: {
          'Authorization': `Bearer ${Token}`
        }
      });
      return response.data.tasks; // Assurez-vous que la structure de réponse est correcte
    } catch (error) {
      console.error('Une erreur s\'est produite lors de la récupération des tâches de l\'utilisateur :', error);
      return [];
    }
  };

  useEffect(() => {
    async function fetchAndSetUserTasks() {
      const tasks = await fetchUserTasks();
      dispatch(updateTaskList(tasks)); // Mettre à jour le state avec les tâches
    }
    fetchAndSetUserTasks();
  }, []); // Appel au chargement initial
  

  
  

  return (
    <View style={styles.container}>
      <Addtodo
        onChangeText={(text) => setNewTodoText(text)}
        onAddTodo={handleAddTodo}
      />
      <ScrollView style={styles.scrollView}>
        <FlatList
          data={todos}
          renderItem={({ item }) => (
            <View style={styles.todoItem}>
              <TouchableOpacity
                style={[
                  styles.toggleButton,
                  item.completed && styles.toggleButtonCompleted,
                ]}
                onPress={() => handleToggle(item.id)}
              >
                <Text style={styles.toggleButtonText}>
                  {item.completed ? "Terminée" : "En cours"}
                </Text>
              </TouchableOpacity>
              {editingTask === item.id ? (
                <TextInput
                  style={styles.editInput}
                  value={editedTaskText}
                  onChangeText={setEditedTaskText}
                  onBlur={handleSaveEdit}
                  autoFocus
                  selectTextOnFocus
                />
              ) : (
                <Text style={styles.todoText}>{item.text}</Text>
              )}
              <View style={styles.buttonContainer}>
                <TouchableOpacity
                  style={[styles.button, styles.editButton]}
                  onPress={() => handleEdit(item.id)}
                >
                  <Text style={styles.buttonText}>Modifier</Text>
                </TouchableOpacity>
                <TouchableOpacity
                  style={[styles.button, styles.deleteButton]}
                  onPress={() => handleDelete(item.id)}
                >
                  <Text style={styles.buttonText}>Supprimer</Text>
                </TouchableOpacity>
              </View>
            </View>
          )}
          keyExtractor={(item) => item.id.toString()}
        />
      </ScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    margin: 12,
    backgroundColor: "#f2f2f2",
  },
  scrollView: {
    flex: 1,
  },
  todoItem: {
    backgroundColor: "#fff",
    padding: 10,
    marginBottom: 10,
    borderRadius: 5,
    borderColor: "#ccc",
    borderWidth: 1,
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "space-between",
  },
  toggleButton: {
    padding: 5,
    borderRadius: 5,
    borderWidth: 1,
    borderColor: "#ccc",
    marginRight: 10,
  },
  toggleButtonCompleted: {
    backgroundColor: "green",
    borderColor: "green",
  },
  toggleButtonText: {
    color: "#333",
    fontWeight: "bold",
  },
  editInput: {
    flex: 1,
    fontSize: 16,
  },
  todoText: {
    flex: 1,
    fontSize: 16,
  },
  buttonContainer: {
    flexDirection: "row",
  },
  button: {
    padding: 8,
    borderRadius: 5,
    marginHorizontal: 5,
  },
  editButton: {
    backgroundColor: "#3498db",
  },
  deleteButton: {
    backgroundColor: "#e74c3c",
  },
  buttonText: {
    color: "#fff",
  },
});

export default TodoList;
