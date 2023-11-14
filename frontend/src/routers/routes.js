

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import( /* component url " */ '../pages/NotesHome.vue')
    },
    {
        path: '/notes/:noteId',
        name: 'note',
        component: () => import('../pages/SingleNote.vue')
    },
    {
        path: '/notes/:noteId/edit',
        name: 'note-edit',
        component: () => import('../pages/EditNote.vue')
    }
];

export default routes;