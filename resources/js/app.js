import './bootstrap';

import '~resources/scss/app.scss';

import.meta.glob([
    '../img/**'
]);

import * as bootstrap from 'bootstrap';

const confirmDelete = document.querySelector('#confirm-delete');
if (confirmDelete)
{
    document.querySelectorAll('.js-delete').forEach(button =>
    {
        button.addEventListener('click', function ()
        {
            let resource = this.dataset.resource;
            let id = this.dataset.id;

            let template;
            if (resource === 'project')
            {
                template = '/admin/projects/*****';
            } else if (resource === 'technology')
            {
                template = '/admin/technologies/*****';
            } else if (resource === 'type')
            {
                template = '/admin/types/*****';
            }

            confirmDelete.action = template.replace('*****', id);

        });
    });
}
