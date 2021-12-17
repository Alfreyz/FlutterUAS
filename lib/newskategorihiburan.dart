import 'dart:async';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutteruas/apiservices.dart';
import 'package:flutteruas/model.dart';
import 'package:flutteruas/newskategoribisnis.dart';
import 'package:flutteruas/newskategorikesehatan.dart';
import 'package:flutteruas/newskategoriolahraga.dart';
import 'package:flutteruas/newskategoritekn.dart';
import 'package:flutteruas/newsly.dart';

class newskategorihiburan extends StatefulWidget {
  const newskategorihiburan({Key? key, required this.title}) : super(key: key);
  final String title;

  @override
  State<newskategorihiburan> createState() => _newskategorihiburan();
}

class _newskategorihiburan extends State<newskategorihiburan> {
  final _formKey = GlobalKey<FormState>();

  List<news> ln = <news>[];

  FutureOr onGoBack(dynamic value){
    setState(() {});
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text(widget.title),
        ),
        drawer: Drawer(
          child: ListView(
            children: <Widget>[
              UserAccountsDrawerHeader(
                accountName: Text("Ferry"),
                accountEmail: Text("Ferry@si.ukdw.ac.id"),
                currentAccountPicture: CircleAvatar(
                  backgroundColor: Colors.white,
                  child: Text(
                    "F",
                    style: TextStyle(fontSize: 40),
                  ),
                ),
              ),
              ListTile(
                title: Text("Berita Terbaru"),
                trailing: Icon(Icons.library_books),
                subtitle: Text("Berita"),
                onTap: (){
                  Navigator.pop(context);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => newsly(title: "Berita Terbaru")),
                  );
                },
              ),
              ListTile(
                title: Text("Berita Teknologi"),
                trailing: Icon(Icons.military_tech),
                subtitle: Text("Berita Teknologi"),
                onTap: (){
                  Navigator.pop(context);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => newskategoritekn(title: "Berita Terbaru")),
                  );
                },
              ),
              ListTile(
                title: Text("Berita Bisnis"),
                trailing: Icon(Icons.money),
                subtitle: Text("Berita Bisnis"),
                onTap: (){
                  Navigator.pop(context);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => newskategoribisnis(title: "Berita Terbaru")),
                  );
                },
              ),
              ListTile(
                title: Text("Berita Hiburan"),
                trailing: Icon(Icons.people),
                subtitle: Text("Berita Hiburan"),
                onTap: (){
                  Navigator.pop(context);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => newskategorihiburan(title: "Berita Terbaru")),
                  );
                },
              ),
              ListTile(
                title: Text("Berita Kesehatan"),
                trailing: Icon(Icons.add_moderator),
                subtitle: Text("Berita Kesehatan"),
                onTap: (){
                  Navigator.pop(context);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => newskategorikesehatan(title: "Berita Terbaru")),
                  );
                },
              ),
              ListTile(
                title: Text("Berita Olahraga"),
                trailing: Icon(Icons.schedule),
                subtitle: Text("Berita Olahraga"),
                onTap: (){
                  Navigator.pop(context);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => newskategoriolahraga(title: "Berita Terbaru")),
                  );
                },
              ),
            ],
          ),
        ),

        body: FutureBuilder<List<news>?>(
          future:ApiServices().getnewshiburan(),
          builder: (BuildContext context, AsyncSnapshot<List<news>?> snapshot){
            if(snapshot.hasError){
              return Center(
                child:Text(
                    "Something wrong with message: ${snapshot.error.toString()}"),
              );
            } else if (snapshot.connectionState == ConnectionState.done) {
              ln = snapshot.data!;
              return ListView.builder(
                itemBuilder: (context, position) {
                  return Card(
                    margin: new EdgeInsets.symmetric(horizontal: 5.0,vertical: 1.0),
                    child: Container(
                      child :ListTile(
                        title: Text(ln[position].tittle + " - " + ln[position].origin +  " - " +ln[position].descriptio ),
                        subtitle: Text(ln[position].date),
                        leading: CircleAvatar(
                          backgroundImage: NetworkImage(ln[position].url_img),
                        ),
                        onTap: () {
                          showDialog(context: context,
                              builder: (_) => AlertDialog(
                                content: Column(
                                  mainAxisSize: MainAxisSize.min,
                                  children: <Widget>[
                                    Divider(
                                      color: Colors.black,
                                      height:20,
                                    ),
                                  ],
                                ),
                              )
                          );
                        },
                      ),
                    ),
                  );
                },
                itemCount: ln.length,
              );
            } else{
              return Center(
                child: CircularProgressIndicator(),
              );
            }
          },
        )
    );
  }
}