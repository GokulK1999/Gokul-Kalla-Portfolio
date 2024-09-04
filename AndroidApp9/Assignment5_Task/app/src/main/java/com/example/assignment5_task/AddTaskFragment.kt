import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import kotlinx.android.synthetic.main.fragment_add_task.*
import java.text.SimpleDateFormat
import java.util.*

class AddTaskFragment : Fragment() {

    private lateinit var dbHelper: TaskDatabaseHelper

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        return inflater.inflate(R.layout.fragment_add_task, container, false)
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        dbHelper = TaskDatabaseHelper(requireContext())

        // Set up click listener for the due date TextView
        textView_due_date.setOnClickListener {
            // Display date picker dialog to select due date
            // Implement logic to show date picker here
        }

        // Set up click listener for the Add Task button
        button_add_task.setOnClickListener {
            // Get values from input fields
            val taskName = edit_text_task_name.text.toString().trim()
            val taskDescription = edit_text_task_description.text.toString().trim()
            val dueDate = textView_due_date.text.toString().trim() // Implement logic to get due date
            val priority = check_box_priority.isChecked

            // Validate input fields
            if (taskName.isEmpty()) {
                edit_text_task_name.error = "Task name is required"
                return@setOnClickListener
            }

            // Create a Task object
            val task = Task(
                name = taskName,
                description = taskDescription,
                dueDate = SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).parse(dueDate), // Parse due date
                priority = priority,
                completed = false
            )

            // Add task to database
            val insertedId = dbHelper.addTask(task)

            // Check if task was inserted successfully
            if (insertedId != -1L) {
                // Task inserted successfully, notify user
                // Implement appropriate action (e.g., show toast, navigate back)
                // For example:
                // Toast.makeText(requireContext(), "Task added successfully", Toast.LENGTH_SHORT).show()
                // requireActivity().supportFragmentManager.popBackStack()
            } else {
                // Task insertion failed, notify user
                // Implement appropriate action (e.g., show error message)
            }
        }
    }
}
