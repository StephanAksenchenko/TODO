import { Component } from '@angular/core';
import { Todo } from './entities/todo';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  todos: Todo[] = [
    {
      title: 'Make todo app',
    },
    {
      title: 'Make deploy',
    },
    {
      title: 'Earn a lot of money',
    },
  ];

  onAddTodo(e: Todo) {
    this.todos.push(e);
  }
}
