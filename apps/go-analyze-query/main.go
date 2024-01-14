package main

import (
	"log"

	zmq "github.com/pebbe/zmq4"
	pg_query "github.com/pganalyze/pg_query_go/v5"
)

func main() {
	responder, err := zmq.NewSocket(zmq.REP)
	if err != nil {
		log.Fatal(err)
	}
	defer responder.Close()
	responder.Bind("tcp://*:6001")

	for {
		query, err := responder.Recv(0)
		if err != nil {
			log.Println(err)
			continue
		}
		log.Println("Received:", query)

		tree, err := pg_query.ParseToJSON(query)
		if err != nil {
			log.Println("Error:", err)

			responder.Send("-", 0)
			continue
		}

		responder.Send(tree, 0)
		log.Println("Sent:", tree)
	}
}
