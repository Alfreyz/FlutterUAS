import 'dart:async';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutteruas/apiservices.dart';
import 'package:flutteruas/model.dart';

class newsdashboard extends StatefulWidget {
  const newsdashboard({Key? key, required this.title}) : super(key: key);
  final String title;

  @override
  State<newsdashboard> createState() => _newsdashboard();
}

class _newsdashboard extends State<newsdashboard> {
  final _formKey = GlobalKey<FormState>();

  List<news> lMhs = <news>[];

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
            ],
          ),
        ),
        body: FutureBuilder<List<news>?>(
          future:ApiServices().getnews(),
          builder: (BuildContext context, AsyncSnapshot<List<news>?> snapshot){
            if(snapshot.hasError){
              return Center(
                child:Text(
                    "Something wrong with message: ${snapshot.error.toString()}"),
              );
            } else if (snapshot.connectionState == ConnectionState.done) {
              lMhs = snapshot.data!;
              return ListView.builder(
                itemBuilder: (context, position) {
                  return Card(
                    margin: new EdgeInsets.symmetric(horizontal: 5.0,vertical: 1.0),
                    child: Container(
                        child :ListTile(
                          title: Text(lMhs[position].tittle + " - " + lMhs[position].origin),
                          subtitle: Text(lMhs[position].date),
                          leading: CircleAvatar(
                            backgroundImage: NetworkImage(lMhs[position].url_img),
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
                        )
                    ),
                  );
                },
                itemCount: lMhs.length,
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