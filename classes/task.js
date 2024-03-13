export class Task {
  #id;
  #title;
  #deadline;
  #priority;

  constructor(title, deadline, priority) {
  this.#id = Math.floor(Math.random() * 9999) + 1;

  this.#title = title;
  this.#deadline = deadline;
  this.#priority = priority;
  }

  getId() {
    return this.#id;
  }

  getTitle() {
    return this.#title;
  }

  setTitle(title) {
    this.#title = title;
  }

  getDeadline() {
    return this.#deadline;
  }

  setDeadline(deadline) {
    this.#deadline = deadline;
  }

  getPriority() {
    return this.#priority;
  }

  setPriority(priority) {
    this.#priority = priority;
  }

  createTaskMarkup() {
    const taskContainer = document.createElement("div");

    const taskValidateButton = document.createElement("btnAjouter");
    taskValidateButton.classList.add("validateTaskButton");
    taskValidateButton.dataset.taskId = this.#id;

    switch (this.#priority) {
      case "1":
        taskValidateButton.classList.add("moyenne");
        break;
      case "2":
        taskValidateButton.classList.add("haute");
        break;
      default:
        taskValidateButton.classList.add("basse");
    }

    const taskTitle = document.createElement("p");
    taskTitle.innerText = this.#title;

    const taskDeadline = document.createElement("p");
    taskDeadline.innerText = new Date(this.#deadline).toDateString();

    taskContainer.append(taskValidateButton, taskTitle, taskDeadline);

    return taskContainer;
  }
}
