import { createRouter, createWebHistory } from "vue-router";
import NotesView from "../views/NotesView.vue";
import NoteCreate from "../views/NoteCreate.vue";
import NoteEdit from "../views/NoteEdit.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Notes",
      component: NotesView,
    },
    {
      path: "/note/create",
      name: "Create Note",
      component: NoteCreate,
    },
    {
      path: "/note/:note_id",
      name: "Edit Note",
      component: NoteEdit,
      props: true,
    },
  ],
});

export default router;
