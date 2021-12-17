import 'dart:convert';
import 'package:charts_flutter/flutter.dart' as charts;
import 'package:flutter/material.dart';

// Dashboard
class DashBoardSI{
  String news;

  DashBoardSI({required this.news,});

  factory DashBoardSI.fromJson(Map<String, dynamic> json){
    return DashBoardSI(
      news: json["news"],
    );
  }
}

// Daftar Mahasiswa

class news{
  String id;
  String tittle;
  String descriptio;
  String url_img;
  String origin;
  String category;
  String date;

  news ({ required this.id, required this.tittle, required this.descriptio, required this.url_img, required this.origin, required this.category, required this.date});

  factory news.fromJson(Map<String, dynamic> map){

    return news(id:map["id"],tittle:map["tittle"],descriptio:map["descriptio"],url_img:map["url_img"],origin:map["origin"],category:map["category"],date:map["date"]);
  }
  Map<String, dynamic> toJson(){
    return{"id":id,"tittle":tittle,"descriptio":descriptio,"url_img":url_img,"origin":origin,"category":category,"date":date};
  }
  @override
  String toString(){
    return 'news{id:$id,tittle:$tittle,descriptio:$descriptio,url_img:$url_img,origin:$origin,category:$category,date:$date}';
  }
}

List<news> newsFromJson(String jsonData){
  final data = json.decode(jsonData);
  return List<news>.from(data.map((item) => news.fromJson(item)));
}

String newsToJson(news data) {
  final jsonData = data.toJson();
  return json.encode(jsonData);
}