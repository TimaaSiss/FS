import api from '../../../constantes';
import { updateTaskList } from './todosSlice';
export const fetchTaskList = async (dispatch) => {
  try {
    const response = await api.get('/task/api-select-task.php');

    if (response.data.status === 200) {
      // Mettre à jour la liste des tâches dans le Redux store
      dispatch(updateTaskList(response.data.taskList)); // Assurez-vous d'avoir une action updateTaskList définie
    } else {
      console.log('Échec de la récupération de la liste des tâches');
    }
  } catch (error) {
    console.error('Une erreur s\'est produite lors de la récupération :', error);
  }
};
