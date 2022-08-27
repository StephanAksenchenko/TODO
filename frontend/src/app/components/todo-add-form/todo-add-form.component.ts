import { Component, EventEmitter, Output } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { Todo } from 'src/app/entities/todo';

@Component({
  selector: 'app-todo-add-form',
  templateUrl: './todo-add-form.component.html',
  styleUrls: ['./todo-add-form.component.scss'],
})
export class TodoAddFormComponent {
  form;

  @Output() onAddTodo: EventEmitter<Todo> = new EventEmitter<Todo>();

  constructor(private formBuilder: FormBuilder) {
    this.form = this.formBuilder.group<Todo>({
      title: '',
    });
  }

  onSubmit() {
    const { title } = this.form.value;

    if (title) {
      this.onAddTodo.emit({
        title,
      });
    }

    this.form.reset();
  }
}
