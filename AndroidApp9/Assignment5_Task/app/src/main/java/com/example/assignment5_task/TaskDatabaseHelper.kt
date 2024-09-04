package com.example.assignment5_task

import android.content.ContentValues
import android.content.Context
import android.database.Cursor
import android.database.sqlite.SQLiteDatabase
import android.database.sqlite.SQLiteOpenHelper
import java.text.SimpleDateFormat
import java.util.*

class TaskDatabaseHelper(context: Context) :
    SQLiteOpenHelper(context, DATABASE_NAME, null, DATABASE_VERSION) {

    companion object {
        private const val DATABASE_VERSION = 1
        private const val DATABASE_NAME = "task_database"
        private const val TABLE_TASKS = "tasks"
        private const val COLUMN_ID = "id"
        private const val COLUMN_NAME = "name"
        private const val COLUMN_DESCRIPTION = "description"
        private const val COLUMN_DUE_DATE = "due_date"
        private const val COLUMN_PRIORITY = "priority"
        private const val COLUMN_COMPLETED = "completed"
    }

    override fun onCreate(db: SQLiteDatabase?) {
        val createTableQuery = "CREATE TABLE $TABLE_TASKS (" +
                "$COLUMN_ID INTEGER PRIMARY KEY AUTOINCREMENT," +
                "$COLUMN_NAME TEXT," +
                "$COLUMN_DESCRIPTION TEXT," +
                "$COLUMN_DUE_DATE TEXT," +
                "$COLUMN_PRIORITY INTEGER," +
                "$COLUMN_COMPLETED INTEGER DEFAULT 0)"

        db?.execSQL(createTableQuery)
    }

    override fun onUpgrade(db: SQLiteDatabase?, oldVersion: Int, newVersion: Int) {
        db?.execSQL("DROP TABLE IF EXISTS $TABLE_TASKS")
        onCreate(db)
    }

    fun addTask(task: Task): Long {
        val db = this.writableDatabase
        val contentValues = ContentValues()
        contentValues.put(COLUMN_NAME, task.name)
        contentValues.put(COLUMN_DESCRIPTION, task.description)
        contentValues.put(COLUMN_DUE_DATE, SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).format(task.dueDate))
        contentValues.put(COLUMN_PRIORITY, if (task.priority) 1 else 0)

        return db.insert(TABLE_TASKS, null, contentValues)
    }

    fun getAllTasks(): List<Task> {
        val taskList = mutableListOf<Task>()
        val db = this.readableDatabase
        val cursor: Cursor? = db.rawQuery("SELECT * FROM $TABLE_TASKS", null)

        cursor?.use {
            while (it.moveToNext()) {
                val id = it.getInt(it.getColumnIndex(COLUMN_ID))
                val name = it.getString(it.getColumnIndex(COLUMN_NAME))
                val description = it.getString(it.getColumnIndex(COLUMN_DESCRIPTION))
                val dueDate = SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).parse(it.getString(it.getColumnIndex(COLUMN_DUE_DATE)))
                val priority = it.getInt(it.getColumnIndex(COLUMN_PRIORITY)) == 1
                val completed = it.getInt(it.getColumnIndex(COLUMN_COMPLETED)) == 1

                val task = Task(id, name, description, dueDate, priority, completed)
                taskList.add(task)
            }
        }

        return taskList
    }

    fun updateTask(task: Task): Int {
        val db = this.writableDatabase
        val contentValues = ContentValues()
        contentValues.put(COLUMN_NAME, task.name)
        contentValues.put(COLUMN_DESCRIPTION, task.description)
        contentValues.put(COLUMN_DUE_DATE, SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).format(task.dueDate))
        contentValues.put(COLUMN_PRIORITY, if (task.priority) 1 else 0)
        contentValues.put(COLUMN_COMPLETED, if (task.completed) 1 else 0)

        return db.update(TABLE_TASKS, contentValues, "$COLUMN_ID = ?", arrayOf(task.id.toString()))
    }

    fun deleteTask(taskId: Int): Int {
        val db = this.writableDatabase
        return db.delete(TABLE_TASKS, "$COLUMN_ID = ?", arrayOf(taskId.toString()))
    }

}
