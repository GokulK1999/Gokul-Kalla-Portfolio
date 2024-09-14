package com.example.assignment4task2

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.ImageView
import android.widget.TextView
import com.bumptech.glide.Glide

class MainActivity2 : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main2)

        var images = intent.getParcelableExtra<Images>("Images")
        if(images != null) {
            var txt: TextView = findViewById(R.id.textViewitemname)
            var img: ImageView = findViewById(R.id.imageViewitem)

            Glide.with(this)
                .load(images.urlimages)
                .into(img)
            txt.text = images.nameimg
        }
    }
}
