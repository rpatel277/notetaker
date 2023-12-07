import { axios } from "../axios/axios";

/**
 * Function to fetch all notes

* @returns {Promise} - Resolves with the all notes data or rejects with an error
 */
export const getAllNotes = () => {
  return axios
    .get("notes")
    .then(({ data }) => {
      return Promise.resolve(data);
    })
    .catch((err) => {
      return Promise.reject(err);
    });
};

/**
 * Function to create a new note
 * @param {Object} payload - The data to be sent in the request body
 *
 * @returns {Promise} - Resolves with the created note's data or rejects with an error
 */
export const createNote = (payload) => {
  return axios
    .post("notes", payload)
    .then(({ data }) => {
      return Promise.resolve(data);
    })
    .catch((err) => {
      return Promise.reject(err);
    });
};

/**
 * Function to retrieve a specific note by ID
 * @param {string} note_id - The ID of the note to retrieve
 *
 * @returns {Promise} - Resolves with the retrieved note's data or rejects with an error
 */
export const getNote = (note_id) => {
  return axios
    .get("notes/" + note_id)
    .then(({ data }) => {
      return Promise.resolve(data);
    })
    .catch((err) => {
      return Promise.reject(err);
    });
};

/**
 * Function to edit/update a specific note by ID
 * @param {string} note_id - The ID of the note to edit/update
 * @param {Object} payload - The data to be updated in the note
 *
 * @returns {Promise} - Resolves with the updated note's data or rejects with an error
 */
export const editNote = (note_id, payload) => {
  return axios
    .put("notes/" + note_id, payload)
    .then(({ data }) => {
      return Promise.resolve(data);
    })
    .catch((err) => {
      return Promise.reject(err);
    });
};

/**
 * Function to delete a specific note by ID
 * @param {string} note_id - The ID of the note to delete
 *
 * @returns {Promise} - Resolves after successful deletion or rejects with an error
 */
export const deleteNote = (note_id) => {
  return axios
    .delete("notes/" + note_id)
    .then(({ data }) => {
      return Promise.resolve(data);
    })
    .catch((err) => {
      return Promise.reject(err);
    });
};
