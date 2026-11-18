// import { addOption, updateQuestionType, removeQuestion } from "./test.js";

// التحقق من تحميل البيانات من window
console.log('🔍 Questions loaded from window:', window.questions);

// تحويل النص إلى كائن JSON إذا لزم الأمر
const questionss = typeof window.questions === 'string' ? JSON.parse(window.questions) : window.questions;

console.log('✅ Parsed Questions:', questionss);

// تعريف المتغير `questions` قبل أي استخدام
let questions = [];

const questionsContainer = document.getElementById('questions-container');

function addQuestions() {
    questionss.forEach((question, index) => {
        const questionId = Date.now() + index; // منع تكرار نفس الـ ID
        const questionItem = document.createElement('div');
        questionItem.classList.add('question-item');
        questionItem.setAttribute('data-id', questionId);

        const grade = question.grade || '';
        const correct = question.correctAnswer || '';
        const title = question.title || '';

        let options = '';
        if (question.type === 'multiple-choice' && Array.isArray(question.options)) {
            question.options.forEach((option, i) => {
                options += `
                    <div class="mb-2 gap-2 d-flex align-items-center">
                        <input type="text" class="form-control option-input" value="${option}" placeholder="Option ${i + 1}" />
                        ${i >= 2 ? `<button type="button" class="btn btn-danger btn-sm remove-option-btn">
                            <img src='../../logos/trash-solid.svg' style='width: 23px; padding: 1px; margin: 3px;'>
                        </button>` : ''}
                    </div>`;
            });
        }

        questionItem.innerHTML = `
            <div class="question-header d-flex justify-content-between align-items-center mb-2">
                <input type="text" value='${title}' class="form-control question-title" placeholder="Enter question title..." required>
                <button type="button" class="btn btn-danger btn-sm btn-action remove-question-btn">
                    <img src='../../logos/trash-solid.svg' style='width: 23px; padding: 1px; margin: 3px;'>
                </button>
            </div>
            <select class="form-select mb-2 question-type">
                <option value="multiple-choice">Multiple Choice</option>
                <option value="short-answer">Short Answer</option>
                <option value="long-answer">Long Answer</option>
            </select>
            <div class="question-options">${options}</div>
            <div class="mb-3">
                <label class="form-label">Grade</label>
                <input type="number" value="${grade}" class="form-control question-grade" placeholder="Enter grade" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correct Answer</label>
                <input type="text" value="${correct}" class="form-control correct-answer" placeholder="Enter correct answer" required>
            </div>`;

        questionsContainer.appendChild(questionItem);
        questions.push(questionId); // تحديث مصفوفة الأسئلة

        questionItem.querySelector('.remove-question-btn').addEventListener('click', () => removeQuestion(questionId));
        questionItem.querySelector('.question-type').addEventListener('change', () => updateQuestionType(questionId));

        setTimeout(() => {
            const addOptionBtn = questionItem.querySelector('.add-option-btn');
            if (addOptionBtn) {
                addOptionBtn.addEventListener('click', () => addOption(questionId));
            }
        }, 0);
    });

    console.log("✅ Questions successfully added:", questions);
}

// استدعاء `addQuestion()` فقط إذا كانت `questionss` مصفوفة صحيحة
if (Array.isArray(questionss)) {
    addQuestions();
}
import { createToast, success, error } from "../../Toster/toster.js";

const quizForm = document.getElementById('quiz-form');
const UpdateForm = document.getElementById('Update');
const addQuestionBtn = document.getElementById('add-question-btn');
const sortable = new Sortable(questionsContainer, {
  animation: 150,
  onEnd: updateQuestionOrder,
});

addQuestionBtn.addEventListener('click', addQuestion);

UpdateForm.addEventListener('submit', Update);


 function addQuestion() {
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
 function removeQuestion(questionId) {
  const questionElement = document.querySelector(`[data-id="${questionId}"]`);
  if (questionElement) {
    questionElement.remove();
    questions = questions.filter(id => id !== questionId);
  }
}

 function updateQuestionType(questionId) {
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

 function addOption(questionId) {
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

 function updateQuestionOrder() {
  questions = Array.from(questionsContainer.querySelectorAll('.question-item')).map(questionElement => {
    const questionId = questionElement.getAttribute('data-id');
    if (questionId) {
      return questionId;
    }
  }).filter(Boolean); // فلترة القيم الغير موجودة (null أو undefined)
}

async function Update(e) {
  e.preventDefault();

  // استرجاع الأسئلة القديمة من sessionStorage
  let storedData = sessionStorage.getItem('ids');
  let oldQuestions = storedData ? JSON.parse(storedData) : [];

  // التحقق من أن oldQuestions هي مصفوفة
  if (!Array.isArray(oldQuestions)) {
    console.error("oldQuestions is not an array:", oldQuestions);
    oldQuestions = []; // تعيينها كمصفوفة فارغة إذا لم تكن مصفوفة
  }

  // دمج الأسئلة القديمة مع الجديدة
  const allQuestions = [...oldQuestions, ...questions];

  const formData = {
    title: document.getElementById('quiz-title').value,
    description: document.getElementById('quiz-description').value,
    code: document.getElementById('codecode').value,
    questions: allQuestions.map(questionId => {
      const questionElement = document.querySelector(`[data-id="${questionId}"]`);
      if (questionElement) {
        return {
          id: questionId, // إرسال ID السؤال القديم
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
    }).filter(Boolean), // التأكد من أن الأسئلة الصحيحة فقط يتم تضمينها
  };

  try {
    const response = await fetch('update.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    });

    const result = await response.text(); // تغيير إلى .text() بدلاً من .json()
    try {
      const parsedResult = JSON.parse(result); // تحليل يدوياً إذا كان JSON
      if (parsedResult.status === 'success') {
        success('Test updated successfully');
      } else {
        error('Failed to update the Test');
      }
    } catch (err) {
      console.error('Unexpected response:', result); // تسجيل الاستجابة غير المتوقعة
      error('An error occurred while saving the quiz.');
    }
  } catch (err) {
    console.error('Error saving quiz:', err);
    error('An error occurred while saving the quiz.');
  }
}

console.log(questions)