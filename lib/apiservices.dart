import 'dart:convert';
import 'dart:io';
import 'package:flutteruas/model.dart';
import 'package:http/http.dart' show Client;
import 'package:http/http.dart' as http;

class ApiServices{

  Client client = Client();
  final String baseUrl = "http://192.168.100.145/SlimMobile/SlimMobileFlutterUAS/public/api/notice";


  Future<List<news>?> getnews() async{
    final response = await client.get(Uri.parse("$baseUrl/news"));
    if (response.statusCode == 200){
      return newsFromJson(response.body);
    } else {
      return null;
    }
  }
  Future<List<news>?> getnewstekn() async{
    final response = await client.get(Uri.parse("$baseUrl/news/Teknologi"));
    if (response.statusCode == 200){
      return newsFromJson(response.body);
    } else {
      return null;
    }
  }
  Future<List<news>?> getnewsbisnis() async{
    final response = await client.get(Uri.parse("$baseUrl/news/Bisnis"));
    if (response.statusCode == 200){
      return newsFromJson(response.body);
    } else {
      return null;
    }
  }
  Future<List<news>?> getnewshiburan() async{
    final response = await client.get(Uri.parse("$baseUrl/news/Hiburan"));
    if (response.statusCode == 200){
      return newsFromJson(response.body);
    } else {
      return null;
    }
  }
  Future<List<news>?> getnewskesehatan() async{
    final response = await client.get(Uri.parse("$baseUrl/news/Kesehatan"));
    if (response.statusCode == 200){
      return newsFromJson(response.body);
    } else {
      return null;
    }
  }
  Future<List<news>?> getnewsolahraga() async{
    final response = await client.get(Uri.parse("$baseUrl/news/Olahraga"));
    if (response.statusCode == 200){
      return newsFromJson(response.body);
    } else {
      return null;
    }
  }
}