import React, { useEffect, useState } from "react";
import { View, StyleSheet, Text, TouchableOpacity, TextInput, ScrollView,} from "react-native";
import { useSelector, useDispatch } from "react-redux";
import { deleteTodo, editTodo, setTodos, toggleTodo } from "./todosSlice";
import { Addtodo } from "./AddTodo";
import api from "../../../constantes";

export function TodoList() {

  const [todos, setTodos] = useState([]);
  const [loading, setloading] = useState(false);
  const dispatch = useDispatch();
  const jwtToken = useSelector((state) => state.user.jwt);
  

  const [editingTask, setEditingTask] = useState(null);
  const [editedTaskText, setEditedTaskText] = useState("");

  const fetchTaskList = async () => {
    setloading(true);
    try {
      const response = await api.get("/user/api-select-user-tasks.php", {
        headers: {
          Authorization: `Bearer ${jwtToken}`, // Utiliser le token JWT dans l'en-tête
        },
      });

      if (response.data.status === 200) {
        const todoslist = response.data.todos;
        setTodos(todoslist);
      } else {
        console.log("Échec de la recuperation des todos de la tâche");
      }
    } catch (error) {
      console.error(
        "Une erreur s'est produite lors de la recuperation :",
        error
      );
    }
    setloading(false);
  };

  useEffect(() => {
    if (jwtToken) {
      fetchTaskList();
    }
  }, [jwtToken]);

  const handleDelete = async (id) => {
    try {
      const response = await api.post(
        "/task/api-delete-task.php",
        {
          id,
        },
        {
          headers: {
            Authorization: `Bearer ${jwtToken}`,
          },
        }
      );
  
      console.log(response.data);
  
      if (response.data.status === 200) {
        const todo = response.data.todo;

        dispatch(deleteTodo({id : id}));// Supprimez la tâche du Redux store
      } else {
        console.log("Échec de la suppression de la tâche");
      }
    } catch (error) {
      console.error("Une erreur s'est produite lors de la suppression :", error);
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
      const response = await api.post(
        "/task/api-update-task.php",
        {
          id: id,
          task_name: editedTaskText,
        },
        {
          headers: {
            Authorization: `Bearer ${jwtToken}`, // Utiliser le token JWT dans l'en-tête
          },
        }
      );
      console.log(response.data);

      if (response.data.status ==="200") {
        const todo = response.data.todo; // Renommez la variable en newTodo
        // dispatch
        dispatch(editTodo({  id : todo.id,  text:todo.text }));
        setText("");
        fetchTaskList(); // Mettre à jour la liste des tâches
        setEditingTask(null);
      } else {
        console.log("Échec de la modification de la tâche");
      }
    } catch (error) {
      console.log(
        "Une erreur s'est produite lors de la modification :",
        error
      );
    }
  };



  return (
    <View style={styles.container}>
      <Addtodo />
      <ScrollView style={styles.scrollView}>
        {todos.length > 0 &&
          todos.map((item) => (
            <View key={item.id} style={styles.todoItem}>
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
                  onBlur={() => handleSaveEdit(item.id)}
                  autoFocus
                  selectTextOnFocus
                />
              ) : (
                <Text style={styles.todoText}>{item.task_name}</Text>
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
          ))}
        {loading && (
          <View>
            <Text>loading.....</Text>
          </View>
        )}
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
