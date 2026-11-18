import { createToast, success, error } from "../../Toster/toster.js";

const quizForm = document.getElementById('quiz-form');
const UpdateForm = document.getElementById('Update');
const addQuestionBtn = document.getElementById('add-question-btn');
const questionsContainer = document.getElementById('questions-container');
let questions = [];
const sortable = new Sortable(questionsContainer, {
  animation: 150,
  onEnd: updateQuestionOrder,
});

addQuestionBtn.addEventListener('click', addQuestion);

quizForm.addEventListener('submit', handleFormSubmit);


export function addQuestion() {
  const questionId = Date.now();
  const questionItem = document.createElement('div');
  questionItem.classList.add('question-item');
  questionItem.setAttribute('data-id', questionId);

  questionItem.innerHTML = 
    `<div class="question-header d-flex justify-content-between align-items-center mb-2">
      <input type="text" class="form-control question-title" placeholder="Enter question title..." required>
      <button type="button" class="btn btn-danger btn-sm btn-action remove-question-btn">
        <img src='../../logos/trash-solid.svg' style='width: 23px; padding: 1px; margin: 3px;'>
      </button>
    </div>
    <select class="form-select mb-2 question-type">
      <option value="multiple-choice">Multiple Choice</option>
      <option value="short-answer">Short Answer</option>
      <option value="long-answer">Long Answer</option>
    </select>
    <div class="question-options">
      <div class="mb-2 gap-2 d-flex align-items-center">
        <input type="text" class="form-control option-input" placeholder="Option 1" />
        <button type="button" class="btn btn-secondary btn-sm add-option-btn">+ Add Option</button>
      </div>
      <div class="mb-2 gap-2">
        <input type="text" class="form-control option-input" placeholder="Option 2" />
      </div>
    </div>
    <div class="mb-3">
      <label for="question-grade-${questionId}" class="form-label">Grade</label>
      <input type="number" class="form-control question-grade" placeholder="Enter grade" required>
    </div>
    <div class="mb-3">
      <label for="correct-answer-${questionId}" class="form-label">Correct Answer</label>
      <input type="text" class="form-control correct-answer" placeholder="Enter correct answer" required>
    </div>`;

  questionsContainer.appendChild(questionItem);
  questions.push(questionId);
console.log(questions)
  questionItem.querySelector('.remove-question-btn')?.addEventListener('click', () => removeQuestion(questionId));
  questionItem.querySelector('.question-type')?.addEventListener('change', () => updateQuestionType(questionId));
  questionItem.querySelector('.add-option-btn')?.addEventListener('click', () => addOption(questionId));
}

export function removeQuestion(questionId) {
  const questionElement = document.querySelector(`[data-id="${questionId}"]`);
  if (questionElement) {
    questionElement.remove();
    questions = questions.filter(id => id !== questionId);
  }
}

export function updateQuestionType(questionId) {
  const questionElement = document.querySelector(`[data-id="${questionId}"]`);
  const questionType = questionElement.querySelector('.question-type').value;
  const optionsContainer = questionElement.querySelector('.question-options');

  if (questionType === 'multiple-choice') {
    optionsContainer.innerHTML = 
      `<div class="mb-2 gap-2 d-flex align-items-center">
        <input type="text" class="form-control option-input" placeholder="Option 1" />
        <button type="button" class="btn btn-secondary btn-sm add-option-btn">+ Add Option</button>
      </div>
      <div class="mb-2 gap-2">
        <input type="text" class="form-control option-input" placeholder="Option 2" />
      </div>`;
    const addOptionBtn = optionsContainer.querySelector('.add-option-btn');
    addOptionBtn?.addEventListener('click', () => addOption(questionId));
  } else {
    optionsContainer.innerHTML = '';
  }
}

export function addOption(questionId) {
  const questionElement = document.querySelector(`[data-id="${questionId}"]`);
  const optionsContainer = questionElement.querySelector('.question-options');

  const optionInput = document.createElement('div');
  optionInput.classList.add('mb-2', 'gap-2', 'd-flex', 'align-items-center');
  optionInput.innerHTML = 
    `<input type="text" class="form-control option-input" placeholder="New Option" />
    <button type="button" class="btn btn-danger btn-sm remove-option-btn">
      <img src='../../logos/trash-solid.svg' style='width: 23px; padding: 1px; margin: 3px;'>
    </button>`;
  optionsContainer.appendChild(optionInput);

  optionInput.querySelector('.remove-option-btn')?.addEventListener('click', () => optionInput.remove());
}

export function updateQuestionOrder() {
  questions = Array.from(questionsContainer.querySelectorAll('.question-item')).map(questionElement => {
    const questionId = questionElement.getAttribute('data-id');
    if (questionId) {
      return questionId;
    }
  }).filter(Boolean); // فلترة القيم الغير موجودة (null أو undefined)
}



async function handleFormSubmit(e) {
  e.preventDefault();

  const formData = {
    title: document.getElementById('quiz-title').value,
    description: document.getElementById('quiz-description').value,
    questions: questions.map(questionId => {
      const questionElement = document.querySelector(`[data-id="${questionId}"]`);
      if (questionElement) {
        return {
          title: questionElement.querySelector('.question-title').value,
          grade: questionElement.querySelector('.question-grade').value,
          type: questionElement.querySelector('.question-type').value,
          correctAnswer: questionElement.querySelector('.correct-answer').value,
          options: Array.from(questionElement.querySelectorAll('.option-input')).map(input => input.value),
        };
      } else {
        console.error(`Question with ID ${questionId} not found.`);
        return null;
      }
    }).filter(Boolean),
  };

  try {
    const response = await fetch('save.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    });

    const result = await response.text();
    try {
      const parsedResult = JSON.parse(result);
      if (parsedResult.status === 'success') {
        success('Test uploaded successfully');
      } else {
        error('Failed to upload the Test');
      }
    } catch (err) {
      console.error('Unexpected response:', result);
      error('An error occurred while saving the quiz.');
    }
  } catch (err) {
    console.error('Error saving quiz:', err);
    error('An error occurred while saving the quiz.');
  }
}