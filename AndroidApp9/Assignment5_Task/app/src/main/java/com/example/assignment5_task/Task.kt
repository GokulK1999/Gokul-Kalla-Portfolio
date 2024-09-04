package com.example.assignment5_task

import java.util.*

data class Task(
    var id: Int = 0,
    var name: String,
    var description: String,
    var dueDate: Date,
    var priority: Boolean,
    var completed: Boolean
)
