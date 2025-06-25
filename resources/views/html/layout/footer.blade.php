<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , made with ❤️ by
            <a href="https://bilaldeveloper.vercel.app/" target="_blank" class="footer-link fw-medium">Bilal A.</a>
        </div>
    </div>
</footer>
<!-- / Footer -->
</div>
</div>


<!-- / Layout wrapper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('../assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ url('../assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ url('../assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ url('../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ url('../assets/vendor/js/menu.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let removedImages = [];

        document.querySelectorAll(".remove-image").forEach(button => {
            button.addEventListener("click", function() {
                let image = this.getAttribute("data-image");
                removedImages.push(image);
                document.getElementById("removeImagesInput").value = JSON.stringify(
                    removedImages);
                this.parentElement.remove();
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = new bootstrap.Carousel(document.querySelector('.carousel'), {
            interval: 3000,
            wrap: true
        });
    });
</script>

<script>
    const STORAGE_KEY = 'daily_tasks';

    function getTasks() {
        return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    }


    function saveTasks(tasks) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(tasks));
    }

    function addTask() {
        const input = document.getElementById('taskInput');
        const taskText = input.value.trim();
        if (!taskText) return;
        const tasks = getTasks();
        tasks.push({
            text: taskText,
            timestamp: Date.now()
        });
        saveTasks(tasks);
        input.value = '';
        renderTasks();
    }

    function deleteTask(index) {
        let tasks = getTasks();
        tasks.splice(index, 1);
        saveTasks(tasks);
        renderTasks();
    }

    function renderTasks() {
        const taskList = document.getElementById('taskList');
        taskList.innerHTML = '';
        const tasks = getTasks();

        tasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2');

            li.innerHTML = `
                <span>• ${task.text}</span>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteTask(${index})">Delete</button>
            `;
            taskList.appendChild(li);
        });
    }

    window.onload = renderTasks;
</script>


<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ url('../assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ url('../assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ url('../assets/js/dashboards-analytics.js') }}"></script>
{{-- <script src="{{url('../assets/js/ajax.js')}}"></script> --}}


<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
