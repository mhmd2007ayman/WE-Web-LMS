// بيانات الدورات التدريبية
const courses = [
    {
        title: "تطوير الويب المتقدم",
        category: "web",
        description: "تعلم كيفية بناء تطبيقات ويب حديثة باستخدام HTML, CSS, JavaScript, وReact.",
        image: "https://via.placeholder.com/300x200",
        link: "#"
    },
    {
        title: "مقدمة في الذكاء الاصطناعي",
        category: "ai",
        description: "تعرف على أساسيات الذكاء الاصطناعي وتعلم كيفية بناء نماذج تعلم آلي.",
        image: "https://via.placeholder.com/300x200",
        link: "#"
    },
    {
        title: "أمن المعلومات الأساسي",
        category: "security",
        description: "تعلم كيفية حماية الأنظمة والشبكات من الهجمات الإلكترونية.",
        image: "https://via.placeholder.com/300x200",
        link: "#"
    },
    {
        title: "تطوير تطبيقات الهاتف",
        category: "web",
        description: "تعلم كيفية بناء تطبيقات الهاتف باستخدام React Native.",
        image: "https://via.placeholder.com/300x200",
        link: "#"
    },
    {
        title: "تحليل البيانات باستخدام Python",
        category: "ai",
        description: "تعلم كيفية تحليل البيانات وإنشاء تقارير باستخدام Python.",
        image: "https://via.placeholder.com/300x200",
        link: "#"
    },
    {
        title: "أمن الشبكات المتقدم",
        category: "security",
        description: "تعلم كيفية تأمين الشبكات باستخدام أدوات متقدمة.",
        image: "https://via.placeholder.com/300x200",
        link: "#"
    }
];

// عرض الدورات
function displayCourses(filteredCourses) {
    const coursesContainer = document.getElementById("coursesContainer");
    coursesContainer.innerHTML = "";

    filteredCourses.forEach(course => {
        const courseCard = `
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="${course.image}" class="card-img-top" alt="${course.title}">
                    <div class="card-body">
                        <h5 class="card-title">${course.title}</h5>
                        <p class="card-text">${course.description}</p>
                        <a href="${course.link}" class="btn btn-primary">المزيد</a>
                    </div>
                </div>
            </div>
        `;
        coursesContainer.innerHTML += courseCard;
    });
}

// تصفية الدورات
function filterCourses() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const filterCategory = document.getElementById("filterCategory").value;

    const filteredCourses = courses.filter(course => {
        const matchesSearch = course.title.toLowerCase().includes(searchInput);
        const matchesCategory = filterCategory === "all" || course.category === filterCategory;
        return matchesSearch && matchesCategory;
    });

    displayCourses(filteredCourses);
}

// تفعيل البحث والتصفية
document.getElementById("searchInput").addEventListener("input", filterCourses);
document.getElementById("filterCategory").addEventListener("change", filterCourses);

// عرض جميع الدورات عند تحميل الصفحة
window.onload = () => {
    displayCourses(courses);
};