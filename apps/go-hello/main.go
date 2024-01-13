package main

import (
	"fmt"
	"log"
	"time"

	zmq "github.com/pebbe/zmq4"
)

func main() {
	// Socket to talk to clients
	responder, err := zmq.NewSocket(zmq.REP)
	if err != nil {
		log.Fatal(err)
	}
	defer responder.Close()
	responder.Bind("tcp://*:6001")

	for {
		// Wait for next request from client
		msg, err := responder.Recv(0)
		if err != nil {
			log.Println(err)
			continue
		}
		log.Println("Received:", msg)

		date := time.Now().Format(msg)

		// Send reply back to client
		reply := fmt.Sprintf("Current date is %s", date)
		responder.Send(reply, 0)
		log.Println("Sent:", reply)
	}
}
